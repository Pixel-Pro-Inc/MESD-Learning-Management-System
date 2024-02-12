const express = require("express");
const router = express.Router();
const UserDataService = require("../services/userDataService");
const GradeDataService = require("../services/gradeDataService");

const userDataService = new UserDataService();
const gradeDataService = new GradeDataService();

const axios = require('axios');
const dotenv = require("dotenv");

// #region Environment Variables

// Load environment variables from .env file
dotenv.config();

const iamDomain =
  process.env.NODE_ENV === "production"
    ? process.env.IAM_PROD_DOMAIN
    : process.env.IAM_DEV_DOMAIN;


// Middleware function to validate bearer token
async function validateToken(req, res, next) {
  try {
    // Extract the bearer token from the Authorization header
    const authHeader = req.headers['authorization'];
    if (!authHeader || !authHeader.startsWith('Bearer ')) {
      return res.status(401).send('Unauthorized');
    }
    const token = authHeader.split(' ')[1];

    // Validate the token using the validateToken method
    const tokenInfo = await validateToken(token);

    // Check if token validation was successful
    if (!tokenInfo || tokenInfo.status !== 'valid') {
      return res.status(401).send('Unauthorized');
    }

    // If token is valid, proceed with the request
    next();
  } catch (error) {
    console.error('Error validating token:', error);
    res.status(500).send('Internal Server Error');
  }
}

async function validateToken(token) {
  try {
    // Define the config for the POST request
    const config = {
      method: 'post',
      url: iamDomain + 'auth/validate-token?token=' + token,
      headers: {
        'Content-Type': 'application/json',
      },
    };

    // Make the POST request using axios
    const response = await axios(config);

    // Return the response data
    return response.data;
  } catch (error) {
    // Handle errors
    console.error('Error:', error);
    return null;
  }
}



// Apply the validateToken middleware to the routes that require token validation
router.get("/users", validateToken, async (req, res) => {
  try {
    setTimeout(async () => {
      const users = await userDataService.fetchAndConsolidateUserData(3306, 1500);
      if (!users) {
        return res.status(404).send("Something went wrong");
      }
      res.json(users);
    }, 10000);
  } catch (error) {
    console.error("Internal Server Error:", error);
    res.status(500).send("Internal Server Error");
  }
});

router.get("/grades", validateToken, async (req, res) => {
  try {
    setTimeout(async () => {
      const grades = await gradeDataService.fetchAndConsolidateGradeData(3306, 1);
      res.json(grades);
    }, 10000)
  } catch (error) {
    console.error("Internal Server Error:", error);
    res.status(500).send("Internal Server Error");
  }
});

module.exports = router;
