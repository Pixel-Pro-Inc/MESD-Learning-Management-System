namespace API.Application.DTOs
{
    public class ResultObject<T>
    {
        public T Value { get; set; }
        public string Error { get; set; }
    }
}
