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

router.get("/:token", async (req, res) => {
  const userId = req.params.token;

  try {
    const userLinks = await databaseService.getUserLinks(userId);

    if (!userLinks || userLinks.length === 0) {
      return res.status(404).send("User not found or no links available");
    }

    if (userLinks.length === 1) {
      // Redirect to the single link available
      res.redirect(userLinks[0].url);
      return; // Make sure to return to avoid further execution
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
