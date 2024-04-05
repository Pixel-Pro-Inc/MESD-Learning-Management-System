namespace API.Application.Interfaces
{
    /// <summary>
    /// This is our implementation of the HttpClient.
    /// It enables us to make web requests.
    /// </summary>
    public interface IHttpClientService
    {
        /// <summary>
        /// This method sends a request with the given request message.
        /// </summary>
        /// <param name="request"></param>
        /// <returns>HttpResponseMessage</returns>
        public Task<HttpResponseMessage> Request(HttpRequestMessage request);
    }
}
