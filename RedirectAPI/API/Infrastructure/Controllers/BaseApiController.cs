using Microsoft.AspNetCore.Mvc;

namespace API.Infrastructure.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class BaseApiController : Controller
    {        
        public BaseApiController()
        {

        }        
    }

}
