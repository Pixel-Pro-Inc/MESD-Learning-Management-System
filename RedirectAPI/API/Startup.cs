using System.Globalization;
using API.Application.Data;
using API.Application.Extensions;
using Microsoft.EntityFrameworkCore;

namespace API
{
    public class Startup
    {
        private readonly IConfiguration _config;
        private readonly string DB_Connection_String= Environment.GetEnvironmentVariable("DB_Connection_String");

        public Startup(IConfiguration config)
        {
            CultureInfo.DefaultThreadCurrentCulture = new CultureInfo("en-US");

            _config = config;
        }

        // This method gets called by the runtime. Use this method to add services to the container.
        public void ConfigureServices(IServiceCollection services)
        {
            services.AddDbContext<RedirectDbContext>(options =>
            options.UseMySQL(DB_Connection_String));

            services.AddMvc();

            services.AddApplicationServices(_config);

            //Here we add the services configuration so that there is memory caching
            services.AddMemoryCache();

            services.AddControllers();
            services.AddCors();
        }

        // This method gets called by the runtime. Use this method to configure the HTTP request pipeline. It's chronologically sensitive so you can't just put anything any how
        public void Configure(IApplicationBuilder app, IWebHostEnvironment env)
        {
            if (env.IsDevelopment() || env.IsStaging())
            {
                app.UseDeveloperExceptionPage();
            }

            app.UseRouting();

            app.UseHsts();

            app.UseHttpsRedirection();

            app.UseCors(x => x.AllowAnyMethod()
                    .AllowAnyHeader()
                    .SetIsOriginAllowed(origin => true)
                    .AllowCredentials());

            app.UseAuthentication();

            app.UseAuthorization();

            app.UseDefaultFiles();
            app.UseStaticFiles();

            app.UseEndpoints(endpoints =>
            {
                endpoints.MapControllers();
            });
        }
    }
}