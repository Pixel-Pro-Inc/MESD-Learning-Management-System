using System.ComponentModel.DataAnnotations;

namespace API.Core.Entities
{
    public class School
    {
        [Key]
        public int Id { get; set; }
        public string Link { get; set; }
    }
}
