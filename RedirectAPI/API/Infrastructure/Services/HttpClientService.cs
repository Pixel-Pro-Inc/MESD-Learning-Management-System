using API.Application.Interfaces;

namespace API.Infrastructure.Services
{
    public class HttpClientService : IHttpClientService
    {
        private readonly HttpClient httpClient;
        public HttpClientService()
        {
            httpClient = new HttpClient();
        }

        public async Task<HttpResponseMessage> Request(HttpRequestMessage request)
        {
            return await httpClient.SendAsync(request);
        }
    }
}
