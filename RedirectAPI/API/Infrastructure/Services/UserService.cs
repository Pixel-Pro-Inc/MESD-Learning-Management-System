using API.Application.Data;
using API.Application.DTOs;
using API.Application.Interfaces;
using API.Core.Entities;
using Microsoft.EntityFrameworkCore;
using Newtonsoft.Json;
using System.Security.Cryptography;
using System.Text;
using System.Web;

namespace API.Infrastructure.Services
{
    public class UserService : IUserService
    {
        private readonly string IAM_DOMAIN;
        private readonly string SHA_SECRET;
        private readonly IHttpClientService _httpClientService;
        private readonly RedirectDbContext _redirectDbContext;

        public UserService(IHttpClientService httpClientService, RedirectDbContext redirectDbContext)
        {
            var configuration = new ConfigurationBuilder()
            .AddJsonFile("appsettings.json")
            .Build();

            IAM_DOMAIN = configuration["IAM_DOMAIN"];
            SHA_SECRET = configuration["SHA_SECRET"];

            _httpClientService = httpClientService;
            _redirectDbContext = redirectDbContext;
        }

        public async Task<ResultObject<string>> RemoveUrl(AddUserDto userDto)
        {
            try
            {
                AppUser appUser = await _redirectDbContext.Users.FirstOrDefaultAsync(user => user.Link == userDto.Link
                && user.UserId == userDto.UserId);

                if (appUser == null)
                    return new ResultObject<string>()
                    {
                        Error = "Link Already Doesn't Exist"
                    };

                _redirectDbContext.Users.Remove(appUser);

                _redirectDbContext.SaveChanges();

                return new ResultObject<string>()
                {
                    Value = "Success"
                };
            }
            catch (Exception ex)
            {
                return new ResultObject<string>()
                {
                    Error = $"Something went wrong: {ex.Message}"
                };
            }
        }

        public async Task<ResultObject<string>> AddUser(AddUserDto userDto)
        {
            try
            {
                if(await _redirectDbContext.Users.AnyAsync(user => user.Link == userDto.Link 
                && user.UserId == userDto.UserId))
                {
                    return new ResultObject<string>()
                    {
                        Error = "Link Already Exists"
                    };
                }

                await _redirectDbContext.Users.AddAsync(new AppUser() { Link = userDto.Link, UserId = userDto.UserId });

                _redirectDbContext.SaveChanges();

                return new ResultObject<string>()
                {
                    Value = "Success"
                };
            }
            catch(Exception ex)
            {
                return new ResultObject<string>()
                {
                    Error = $"Something went wrong: {ex.Message}"
                };
            }
        }

        public async Task<ResultObject<IEnumerable<string>>> GetUserLinks(string token)
        {
            string userId = await ValidateToken(token);

            if(string.IsNullOrEmpty(userId))
                return new ResultObject<IEnumerable<string>>()
                {
                    Error = "Invalid Token"
                };

            try
            {
                List<string> _links = (await _redirectDbContext
                                .Users.Where(user => user.UserId == userId)
                                .ToListAsync()).Select(user => user.Link).ToList();

                if (!_links.Any())
                    return new ResultObject<IEnumerable<string>>()
                    {
                        Error = "User not found"
                    };

                List<string> links = new List<string>();

                foreach (var link in _links)
                {
                    links.Add($"{link}{HashUserId(userId)}&token={token}");
                }

                return new ResultObject<IEnumerable<string>>()
                {
                    Value = links
                };
            }
            catch(Exception ex)
            {
                return new ResultObject<IEnumerable<string>>()
                {
                    Error = $"User not found {ex.Message}"
                };
            }
        }

        private string HashUserId(string userId)
        {
            // Convert the secret key to bytes
            byte[] keyBytes = Encoding.UTF8.GetBytes(SHA_SECRET);

            // Convert the user ID to bytes
            byte[] userIdBytes = Encoding.UTF8.GetBytes(userId);

            // Create an instance of HMACSHA256 with the secret key
            using (HMACSHA256 hmac = new HMACSHA256(keyBytes))
            {
                // Compute the hash
                byte[] hashBytes = hmac.ComputeHash(userIdBytes);

                // Convert the hash to Base64 string
                string base64Digest = Convert.ToBase64String(hashBytes);

                // URL encode the Base64 string
                string encodedDigest = HttpUtility.UrlEncode(base64Digest);

                return encodedDigest;
            }
        }

        private async Task<string> ValidateToken(string token)
        {
            using (var requestMessage =
            new HttpRequestMessage(HttpMethod.Post, $"{IAM_DOMAIN}auth/validate-token?token={token}"))
            {
                var response = await _httpClientService.Request(requestMessage);

                //Handle Error
                if (!response.IsSuccessStatusCode)
                    return null;

                string responseString = await response.Content.ReadAsStringAsync();

                var result = JsonConvert.DeserializeObject<dynamic>(responseString);

                return (string)result.username;
            }
        }
    }
}
