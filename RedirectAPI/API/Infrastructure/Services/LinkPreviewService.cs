using API.Application.Interfaces;
using API.Core.Model;
using HtmlAgilityPack;

namespace API.Infrastructure.Services
{
    public class LinkPreviewService : ILinkPreviewService
    {
        public async Task<LinkPreview> GetLinkPreviewAsync(string url)
        {
            try
            {
                var domain = new Uri(url).GetLeftPart(UriPartial.Authority);

                var httpClient = new HttpClient();
                var html = await httpClient.GetStringAsync(domain);

                var doc = new HtmlDocument();
                doc.LoadHtml(html);

                var title = doc.DocumentNode.SelectSingleNode("//title")?.InnerText.Trim();
                var favicons = doc.DocumentNode.SelectNodes("//link[@rel='icon' or @rel='shortcut icon']")
                    ?.Select(n => n.GetAttributeValue("href", "").Trim())
                    .ToList();

                return new LinkPreview
                {
                    Url = url,
                    Title = title,
                    Favicons = favicons
                };
            }
            catch (Exception)
            {
                return null;
            }
        }

    }
}
