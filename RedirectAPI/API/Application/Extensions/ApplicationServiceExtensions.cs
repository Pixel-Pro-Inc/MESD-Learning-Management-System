using API.Application.Interfaces;
using API.Infrastructure.Services;

namespace API.Application.Extensions
{
    public static class ApplicationServiceExtensions
    {
        public static IServiceCollection AddApplicationServices(this IServiceCollection services, IConfiguration config)
        {
            services.AddSingleton<IHttpClientService, HttpClientService>();
            services.AddScoped<IUserService, UserService>();
            services.AddScoped<ILinkPreviewService, LinkPreviewService>();

            return services;
        }
    }
}
