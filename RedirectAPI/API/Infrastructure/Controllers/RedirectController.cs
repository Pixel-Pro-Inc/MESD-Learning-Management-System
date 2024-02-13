using API.Application.DTOs;
using API.Application.Interfaces;
using API.Core.Model;
using Microsoft.AspNetCore.Mvc;

namespace API.Infrastructure.Controllers
{
    public class RedirectController : BaseApiController
    {
        private readonly IUserService _userService;
        private readonly ILinkPreviewService _linkPreviewService;

        public RedirectController(IUserService userService, ILinkPreviewService linkPreviewService)
        {
            _userService = userService;
            _linkPreviewService = linkPreviewService;
        }

        [HttpGet]
        public async Task<ActionResult> RedirectUser([FromQuery] string token)
        {
            ResultObject<IEnumerable<string>> resultObject = await _userService.GetUserLinks(token);

            if (resultObject.Error != null)
                return BadRequest(resultObject.Error);

            if(resultObject.Value.Count() == 0)
                return BadRequest("User not found");

            if (resultObject.Value.Count() == 1)
                return new RedirectResult(resultObject.Value.First());

            var linkPreviews = new List<LinkPreview>();

            foreach (var link in resultObject.Value)
            {
                var linkPreview = await _linkPreviewService.GetLinkPreviewAsync(link);
                if (linkPreview != null)
                {
                    linkPreviews.Add(linkPreview);
                }
            }

            //Show User Links HTML
            return View("~/Presentation/RedirectController/LinkView.cshtml", linkPreviews);
        }
    }
}
