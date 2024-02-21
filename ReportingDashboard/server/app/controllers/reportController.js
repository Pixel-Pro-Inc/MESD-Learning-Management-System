const express = require("express");
const router = express.Router();
const UserDataService = require("../services/userDataService");
const GradeDataService = require("../services/gradeDataService");

const userDataService = new UserDataService();
const gradeDataService = new GradeDataService();

router.get("/users", async (req, res) => {
  try {
    const users = await userDataService.fetchAndConsolidateUserData(
      process.env.NUM_DBS
    );

    if (!users) {
      return res.status(404).send("Something went wrong");
    }

    // Send the users back as a response
    res.json(users);
  } catch (error) {
    console.error("Internal Server Error:", error);
    res.status(500).send("Internal Server Error");
  }
});

router.get("/grades", async (req, res) => {
  try {
    const grades = await gradeDataService.fetchAndConsolidateGradeData(
      process.env.NUM_DBS
    );

    res.json(grades);
  } catch (error) {
    console.error("Internal Server Error:", error);
    res.status(500).send("Internal Server Error");
  }
});

module.exports = router;
