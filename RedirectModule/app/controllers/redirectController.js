// redirectController.js
const express = require("express");
const router = express.Router();
const linkPreview = require("link-preview-js");
const DatabaseService = require("../services/databaseService");

const databaseService = new DatabaseService();

// Define an async function to fetch link previews
async function fetchLinkPreviews(userLinks) {
  const linkPreviews = [];

  for (const link of userLinks) {
    try {
      const data = await linkPreview.getLinkPreview(link);
      linkPreviews.push(data);
    } catch (error) {
      console.error(`Error fetching link preview for ${link}:`, error);
      // Handle the error if needed
    }
  }

  return linkPreviews;
}

router.get("/:userId", async (req, res) => {
  const userId = req.params.userId;

  try {
    const userLinks = await databaseService.getUserLinks(userId);

    if (!userLinks || userLinks.length === 0) {
      return res.status(404).send("User not found or no links available");
    }

    // Fetch link previews for each link one by one
    const linkPreviews = await fetchLinkPreviews(userLinks);

    res.render("linkSelectionPage.ejs", { userLinks, linkPreviews });
  } catch (error) {
    console.error("Internal Server Error:", error);
    res.status(500).send("Internal Server Error");
  }
});

module.exports = router;
