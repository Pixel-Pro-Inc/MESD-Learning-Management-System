using API.Application.DTOs;
using API.Application.Interfaces;
using Microsoft.AspNetCore.Mvc;

namespace API.Infrastructure.Controllers
{
    public class UserController : BaseApiController
    {
        private readonly IUserService _userService;
        public UserController(IUserService userService)
        {
            _userService = userService;
        }

        [HttpPost("addUser")]
        public async Task<ActionResult> AddUser(AddUserDto addUserDto)
        {
            ResultObject<string> resultObject = await _userService.AddUser(addUserDto);

            if (resultObject.Error != null)
                return BadRequest(resultObject.Error);

            return Ok(resultObject.Value);
        }

        [HttpPost("removeUrl")]
        public async Task<ActionResult> RemoveUrl(AddUserDto addUserDto)
        {
            ResultObject<string> resultObject = await _userService.RemoveUrl(addUserDto);

            if (resultObject.Error != null)
                return BadRequest(resultObject.Error);

            return Ok(resultObject.Value);
        }
    }
}
