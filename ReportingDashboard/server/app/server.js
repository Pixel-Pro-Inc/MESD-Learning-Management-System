// server.js
const express = require("express");
const https = require("https");
const reportController = require("./controllers/reportController");
const accountController = require("./controllers/accountController");
const { credentials, serverConfig } = require("./config");
const path = require("path");

const app = express();
const serverPort = serverConfig.port;

const httpsServer = https.createServer(credentials, app);

app.use(express.json());

// Use controllers
app.use("/api/report", reportController);
app.use("/api/account", accountController);

httpsServer.listen(serverPort, () => {
  console.log(`Server is running on https://localhost:${serverPort}`);
});

app.use(express.static(path.join(__dirname, "../client/wwwroot")));

app.get("*", (req, res) => {
  res.sendFile(path.join(__dirname, "../client/wwwroot/index.html"));
});
