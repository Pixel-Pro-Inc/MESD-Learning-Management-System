using System.ComponentModel.DataAnnotations;

namespace API.Core.Entities
{
    public class AppUser
    {
        [Key]
        public int Id { get; set; }
        public string UserId { get; set; }
        public string Link { get; set; }
    }
}