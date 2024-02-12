// databaseService.js
const jwt = require("jsonwebtoken");
const { mariadbConfig } = require("../config");
const mariadb = require("mariadb");
const crypto = require("crypto");
// config.js
const dotenv = require("dotenv");

// #region Environment Variables

// Load environment variables from .env file
dotenv.config();

const shaSecret =
  process.env.NODE_ENV === "production"
    ? process.env.SHA_PROD_SECRET
    : process.env.SHA_DEV_SECRET;

class DatabaseService {
  constructor() {
    this.pool = mariadb.createPool(mariadbConfig);
    this.initializeDatabase();
  }

  async initializeDatabase() {
    const createTableQuery = `
      CREATE TABLE IF NOT EXISTS user_links (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id VARCHAR(255) NOT NULL,
        link VARCHAR(255) NOT NULL,
        UNIQUE KEY unique_user_link (user_id, link)
      )
    `;

    try {
      await this.query(createTableQuery);
    } catch (error) {
      console.error("Error creating table:", error);
      throw error;
    }
  }

  async query(sql, params) {
    let connection;
    try {
      connection = await this.pool.getConnection();
      const results = await connection.query(sql, params);
      return results;
    } finally {
      if (connection) {
        connection.release();
      }
    }
  }

  async getUserLinks(token) {
    const decoded = jwt.decode(token);

    //Verify token Authenticity

    let userId = decoded ? decoded.preferred_username : token;

    const sql = "SELECT link FROM user_links WHERE user_id = ?";
    const params = [userId];

    try {
      const results = await this.query(sql, params);

      //loop through strings
      //append nin & token
      let links = results.map((result) => result.link);

      let linksResult = [];

      for (let link of links) {
        link += this.hashUserId(userId) + "&token=" + token;

        linksResult.push(link);
      }

      return linksResult;
    } catch (error) {
      console.error("Error querying the database:", error);
      throw error;
    }
  }

  async addUser(userId, links) {
    const existingLinks = await this.getUserLinks(userId);

    // Combine existing links with new links, ensuring no duplicates
    const uniqueLinks = Array.from(new Set([...existingLinks, ...links]));

    const sql = `
      INSERT INTO user_links (user_id, link)
      VALUES (?, ?)
      ON DUPLICATE KEY UPDATE link = VALUES(link)
    `;

    try {
      // Insert or update the user's links
      await Promise.all(
        uniqueLinks.map((link) => this.query(sql, [userId, link]))
      );
    } catch (error) {
      console.error("Error inserting/updating into the database:", error);
      throw error;
    }
  }

  secretKey = shaSecret;

  hashUserId(userId) {
    // Create an HMAC-SHA256 hash using the secret key
    const hmac = crypto.createHmac("sha256", this.secretKey);
    hmac.update(userId);

    // Get the digest in Base64 representation
    const base64Digest = hmac.digest("base64");

    return encodeURIComponent(base64Digest);
  }
}

module.exports = DatabaseService;
