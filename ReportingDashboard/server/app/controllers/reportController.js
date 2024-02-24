const express = require("express");
const axios = require('axios');
const dotenv = require("dotenv");
const router = express.Router();
const UserDataService = require("../services/userDataService");
const GradeDataService = require("../services/gradeDataService");

const userDataService = new UserDataService();
const gradeDataService = new GradeDataService();

const iamDomain =
  process.env.NODE_ENV === "production"
    ? process.env.IAM_PROD_DOMAIN
    : process.env.IAM_DEV_DOMAIN;

router.get("/users", async (req, res) => {
  try {
    // Extracting token from authorization header
    const authorizationHeader = req.headers['authorization'];
    if (!authorizationHeader || !authorizationHeader.startsWith('Bearer ')) {
      res.status(401).send('Unauthorized. Bearer token missing.');
      return;
    }

    const token = authorizationHeader.split(' ')[1];
    console.error(token);

    let tokenResponse = await validateToken(token);
    if (tokenResponse === null) {
      res.status(401).send('You are unauthorized');
    }
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
    // Extracting token from authorization header
    const authorizationHeader = req.headers['authorization'];
    if (!authorizationHeader || !authorizationHeader.startsWith('Bearer ')) {
      res.status(401).send('Unauthorized. Bearer token missing.');
      return;
    }

    const token = authorizationHeader.split(' ')[1];

    let tokenResponse = await validateToken(token);
    if (tokenResponse === null) {
      res.status(401).send('You are unauthorized');
    }
    const grades = await gradeDataService.fetchAndConsolidateGradeData(
      process.env.NUM_DBS
    );

    res.json(grades);
  } catch (error) {
    console.error("Internal Server Error:", error);
    res.status(500).send("Internal Server Error");
  }
});

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

    let response = await axios(config);
    if (!response.data.realm_access.roles.includes(process.env.ACCEPTED_ROLE)) {
      return null;
    }

    return response.data;
  } catch (error) {
    // Handle errors
    console.error('Error:', error);
    return null;
  }
}

module.exports = router;
