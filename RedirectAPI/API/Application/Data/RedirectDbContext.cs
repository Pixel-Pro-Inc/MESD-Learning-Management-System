using API.Core.Entities;
using Microsoft.EntityFrameworkCore;

namespace API.Application.Data
{
    public class RedirectDbContext : DbContext
    {
        public RedirectDbContext(DbContextOptions<RedirectDbContext> options)
        : base(options)
        {
        }

        // DbSet properties represent database tables
        public DbSet<AppUser> Users { get; set; }
        public DbSet<School> Schools { get; set; }
    }
}
