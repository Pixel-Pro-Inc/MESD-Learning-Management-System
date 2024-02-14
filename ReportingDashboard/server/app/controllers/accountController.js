const express = require("express");
const axios = require('axios');
const router = express.Router();
const dotenv = require("dotenv");

// #region Environment Variables

// Load environment variables from .env file
dotenv.config();

const iamDomain =
  process.env.NODE_ENV === "production"
    ? process.env.IAM_PROD_DOMAIN
    : process.env.IAM_DEV_DOMAIN;

/** 
 * Login endpoint*/   
router.post("/login", async (req, res) => {

  try {
    //Take user credentials and handle login from 1Gov
    const postData = req.body;

    // Define the config for the POST request
    const config = {
      method: 'post',
      url: iamDomain + 'auth/login/sms',
      headers: {
        'Content-Type': 'application/json',
      },
      data: postData
    };

    // Make the POST request using axios
    axios(config)
      .then(function (response) {
        //if successful
        //return to main screen popup otp prompt
        res.json(response.data);
      })
      .catch(function (error) {
        res.status(400).json('Invalid Credentials');
      });
  } catch (error) {
    console.error("Internal Server Error:", error);
    res.status(500).send("Internal Server Error");
  }
});

router.post("/otp", async (req, res) => {
  try {
    //Take user credentials and handle login from 1Gov
    const postData = req.body;

    // Define the config for the POST request
    const config = {
      method: 'post',
      url: iamDomain + 'auth/validate/otp',
      headers: {
        'Content-Type': 'application/json',
      },
      data: postData
    };

    // Make the POST request using axios
    axios(config)
      .then(async function (response) {
        let token = response.data.access_token;
        let refreshToken = response.data.refresh_token;
        let expiryTime = response.data.expires_in;

        let user = await validateToken(token);

        if (user == null) {
          res.status(400).json('Something went wrong');
        }

        if (!user.realm_access.roles.includes("CUSTOMER")) {
          res.status(400).json('You Are Not Authorized To Use This Platform');
        }

        res.json({
          token: token,
          refreshToken: refreshToken,
          expiryTime: expiryTime,
          firstname: user.given_name,
          lastname: user.family_name,
        });
      })
      .catch(function (error) {
        res.status(400).json('Invalid OTP');
      });
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

    return response.data;
  } catch (error) {
    // Handle errors
    console.error('Error:', error);
    return null;
  }
}


router.get("/sso", async (req, res) => {
  const token = req.query.token;

  try {
    let user = await validateToken(token);

    if (user == null) {
      res.status(400).json('Something went wrong');
    } else if (!user.realm_access.roles.includes("CUSTOMER")) {
      res.status(400).json('You Are Not Authorized To Use This Platform');
    } else {
      res.json({
        token: token,
        firstname: user.given_name,
        lastname: user.family_name,
      });
    }
  } catch (error) {
    console.error("Internal Server Error:", error);
    res.status(500).send("Internal Server Error");
  }
});

module.exports = router;
