const mysql = require("mysql");
const { dbConfig } = require("../config");

class GradeDataService {
  // Function to connect to a MySQL database and fetch data
  async getGrades(config) {
    return new Promise((resolve, reject) => {
      const connection = mysql.createConnection(config);

      connection.connect((err) => {
        if (err) {
          reject(err);
          return;
        }

        connection.query(`SELECT * FROM mdl_grade_grades`, (error, results) => {
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

  // Function to connect to a MySQL database and fetch data
  async getGradeItems(config) {
    return new Promise((resolve, reject) => {
      const connection = mysql.createConnection(config);

      connection.connect((err) => {
        if (err) {
          reject(err);
          return;
        }

        connection.query(`SELECT * FROM mdl_grade_items`, (error, results) => {
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

  // Function to connect to a MySQL database and fetch data
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
  async fetchAndConsolidateGradeData(numDatabases) {
    let allGrades = [];

    for (let index = 0; index < numDatabases; index++) {
      try {
        let collection = [];

        let config = dbConfig;

        config.host = index == 0 ? "db" : "db" + index;

        const grades = await this.getGrades(config);

        const gradeItems = await this.getGradeItems(config);

        const userInfoData = await this.getUserInfoData(config);

        const courses = await this.getCourses(config);

        let aggregatedGrades = {};

        grades.forEach((grade) => {
          gradeItems.forEach((item) => {
            if (item.id === grade.itemid) {
              courses.forEach((course) => {
                if (course.id === item.courseid) {
                  userInfoData.forEach((info) => {
                    if (info.userid === grade.userid) {
                      let courseName = course.fullname;
                      let level = "";
                      let organization = "";

                      if (info.fieldid === 8) {
                        level = info.data;
                      }

                      organization = courses.find(
                        (course) => course.id === 1
                      ).fullname;

                      let key = `${courseName}-${level}-${organization}`;

                      if (!aggregatedGrades[key]) {
                        aggregatedGrades[key] = {
                          course: courseName,
                          level: level,
                          organization: organization,
                          totalGrade: 0,
                          count: 0,
                        };
                      }

                      aggregatedGrades[key].totalGrade +=
                        (grade.rawgrade / grade.rawgrademax) * 100;
                      aggregatedGrades[key].count++;
                    }
                  });
                }
              });
            }
          });
        });

        // Calculate averages and add to allGrades
        Object.values(aggregatedGrades).forEach((aggregatedGrade) => {
          aggregatedGrade.averageGrade =
            aggregatedGrade.totalGrade / aggregatedGrade.count;
          delete aggregatedGrade.totalGrade;
          delete aggregatedGrade.count;
          collection.push(aggregatedGrade);
        });

        allGrades.push(collection);
      } catch (error) {
        continue;
      }
    }

    return allGrades;
  }
}

module.exports = GradeDataService;
