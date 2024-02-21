const { dbConfig } = require("../config");
const mysql = require("mysql");

class UserDataService {
  // Function to connect to a MySQL database and fetch users
  async getUsers(config) {
    return new Promise((resolve, reject) => {
      const connection = mysql.createConnection(config);

      connection.connect((err) => {
        if (err) {
          reject(err);
          return;
        }

        connection.query(`SELECT * FROM mdl_user`, (error, results) => {
          connection.end();
          if (error) {
            reject(error);
            return;
          }
          resolve(results);
        });
      });
    });
  }

  // Function to connect to a MySQL database and fetch user info data
  async getUserInfoData(config) {
    return new Promise((resolve, reject) => {
      const connection = mysql.createConnection(config);

      connection.connect((err) => {
        if (err) {
          reject(err);
          return;
        }

        connection.query(
          `SELECT * FROM mdl_user_info_data`,
          (error, results) => {
            connection.end();
            if (error) {
              reject(error);
              return;
            }
            resolve(results);
          }
        );
      });
    });
  }

  // Function to connect to a MySQL database and fetch user info field data
  async getUserInfoFieldData(config) {
    return new Promise((resolve, reject) => {
      const connection = mysql.createConnection(config);

      connection.connect((err) => {
        if (err) {
          reject(err);
          return;
        }

        connection.query(
          `SELECT * FROM mdl_user_info_field`,
          (error, results) => {
            connection.end();
            if (error) {
              reject(error);
              return;
            }
            resolve(results);
          }
        );
      });
    });
  }

  // Function to connect to a MySQL database and fetch data
  async getCourses(config) {
    return new Promise((resolve, reject) => {
      const connection = mysql.createConnection(config);

      connection.connect((err) => {
        if (err) {
          reject(err);
          return;
        }

        connection.query(`SELECT * FROM mdl_course`, (error, results) => {
          connection.end();
          if (error) {
            reject(error);
            return;
          }
          resolve(results);
        });
      });
    });
  }

  // Function to fetch and consolidate all user info data and field data
  async fetchAndConsolidateUserData(numDatabases) {
    let allUsers = [];

    for (let index = 0; index < numDatabases; index++) {
      try {
        let config = dbConfig;

        config.host = index == 0 ? "db" : "db" + index;

        const users = await this.getUsers(config);

        const userInfoData = await this.getUserInfoData(config);

        const userInfoFieldData = await this.getUserInfoFieldData(config);

        const courses = await this.getCourses(config);

        // Create a map of user info field data for easier access
        const userInfoFieldMap = userInfoFieldData.reduce((map, field) => {
          map[field.id] = field;
          return map;
        }, {});

        // Add user info data to each user object
        users.forEach((user) => {
          userInfoData.forEach((info) => {
            if (info.userid === user.id) {
              const fieldName = userInfoFieldMap[info.fieldid].shortname;
              user[fieldName] = info.data;
              user["organization"] = courses.filter(
                (course) => course.id === 1
              )[0].fullname;
            }
          });

          if (!allUsers.includes(user) && !user.deleted) {
            allUsers.push(user);
          }
        });
      } catch (error) {
        continue;
      }
    }

    return allUsers;
  }
}

module.exports = UserDataService;
