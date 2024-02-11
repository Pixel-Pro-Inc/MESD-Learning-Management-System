// server.js
const express = require("express");
const https = require("https");
const path = require("path");
const redirectController = require("./controllers/redirectController");
const userController = require("./controllers/userController");
const { credentials, serverConfig } = require("./config");

const app = express();
const serverPort = serverConfig.port;

const httpsServer = https.createServer(credentials, app);

app.use(express.json());

// Require static assets from public folder
app.use(express.static(path.join(__dirname, "public")));

// Set 'views' directory for any views
// being rendered res.render()
app.set("views", path.join(__dirname, "views"));

// Set view engine as EJS
app.engine("html", require("ejs").renderFile);
app.set("view engine", "html");

// Use controllers
app.use("/api/redirect", redirectController);
app.use("/api/user", userController);

httpsServer.listen(serverPort, () => {
  console.log(`Server is running on https://localhost:${serverPort}`);
});
