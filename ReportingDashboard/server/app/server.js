// server.js
const express = require("express");
const http = require("http");
const reportController = require("./controllers/reportController");
const accountController = require("./controllers/accountController");
const { credentials, serverConfig } = require("./config");
const path = require("path");

const app = express();
const serverPort = serverConfig.port;

const httpServer = http.createServer(credentials, app);

app.use(express.json());

// Use controllers
app.use("/api/report", reportController);
app.use("/api/account", accountController);

httpServer.listen(serverPort, () => {
  console.log(`Server is running on http://localhost:${serverPort}`);
});

app.use(express.static(path.join(__dirname, "./wwwroot")));

app.get("*", (req, res) => {
  res.sendFile(path.join(__dirname, "./wwwroot/index.html"));
});
