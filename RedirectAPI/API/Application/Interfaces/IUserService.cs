using API.Application.DTOs;

namespace API.Application.Interfaces
{
    public interface IUserService
    {
        public Task<ResultObject<string>> AddUser(AddUserDto userDto);
        public Task<ResultObject<string>> RemoveUrl(AddUserDto userDto);
        public Task<ResultObject<IEnumerable<string>>> GetUserLinks(string token);
    }
}
