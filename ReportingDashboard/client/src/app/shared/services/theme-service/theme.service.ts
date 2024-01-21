import { HttpClient } from '@angular/common/http';
import { Injectable, Renderer2 } from '@angular/core';
import { map } from 'rxjs/operators';
import { environment } from 'src/environments/environment';
import { SetThemeDto } from '../../models/set-theme-dto';
import { Theme } from '../../models/theme';
import { Title } from '@angular/platform-browser';

@Injectable({
  providedIn: 'root',
})
export class ThemeService {
  constructor(private httpClient: HttpClient, private titleService: Title) {}

  cachedTheme: Theme = null;

  getTheme() {
    return this.httpClient.get(environment.apiUrl + 'theme/get-theme').pipe(
      map((response: Theme) => {
        return response;
      })
    );
  }

  setTheme(setThemeDto: SetThemeDto) {
    return this.httpClient
      .post(environment.apiUrl + 'theme/set-theme', setThemeDto)
      .pipe(
        map((response: Theme) => {
          return response;
        })
      );
  }

  applyTheme(theme: Theme, renderer: Renderer2, document: Document) {
    //Set Window Title
    this.titleService.setTitle(theme.windowTitle);
    //Set Fav Icon
    const link: HTMLLinkElement =
      document.querySelector("link[rel='icon']") ||
      document.createElement('link');
    link.type = 'image/x-icon';
    link.rel = 'icon';
    link.href = theme.favIcon;

    renderer.appendChild(document.head, link);

    //Set Styles
    const styleElement = renderer.createElement('style');
    const styleContent = `
    :root {
      --light: ${theme.lightColor};
      --link-color: ${theme.linkColor};
      --accent-color: ${theme.accentColor};
      --secondary-color: ${theme.secondaryColor};
      --gray: ${theme.grayColor};
      --light-gray: ${theme.lightGrayColor};
      --lightest-gray: ${theme.lightestGrayColor};
      --medium-gray: ${theme.mediumGrayColor};
      --dark-gray: ${theme.darkGrayColor};
      --darkest-gray: ${theme.darkestGrayColor};
      --logo-name: url("${theme.logoName}");
      --logo: url("${theme.logo}");
    }
  `;

    renderer.appendChild(styleElement, renderer.createText(styleContent));
    renderer.appendChild(document.head, styleElement);

    this.cachedTheme = theme;
  }
}
