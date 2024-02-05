const express = require("express");
const router = express.Router();

router.get("/login", async (req, res) => {
  try {
    //Take user credentials and handle login from 1Gov
    //Validate OTP
    //Validate Role
    const users = await userDataService.fetchAndConsolidateUserData(3306, 1500);

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

router.get("/sso", async (req, res) => {
  //Validate Token
  //Validate Role
  try {
    const users = await userDataService.fetchAndConsolidateUserData(3306, 1500);

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

module.exports = router;
