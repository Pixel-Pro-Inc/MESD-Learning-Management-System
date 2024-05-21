using Microsoft.AspNetCore.Mvc;

namespace API.Infrastructure.Controllers
{
	public class SessionController : BaseApiController
	{
		[HttpGet("timeout")]
		public async Task<ActionResult> SessionTimeOut()
		{
			return View("~/Presentation/SessionController/SessionTimeOut.cshtml");
		}
	}
}
