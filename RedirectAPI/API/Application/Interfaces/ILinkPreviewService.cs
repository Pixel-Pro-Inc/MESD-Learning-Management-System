using API.Core.Model;

namespace API.Application.Interfaces
{
    public interface ILinkPreviewService
    {
        Task<LinkPreview> GetLinkPreviewAsync(string url);
    }
}
