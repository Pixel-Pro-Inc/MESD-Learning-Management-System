import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';
import { MenuItemDto } from 'src/app/shared/models/menu-item-dto';
import { MenuRequestDto } from 'src/app/shared/models/menu-request-dto';
import { environment } from 'src/environments/environment';
import { CreateMenuItemDto } from '../../models/create-menu-item-dto';

@Injectable({
  providedIn: 'root',
})
export class MenuService {
  constructor(private httpClient: HttpClient) {}

  getMenuItems(menuRequestDto: MenuRequestDto) {
    return this.httpClient
      .post(environment.apiUrl + 'menu/get-menuitems', menuRequestDto)
      .pipe(
        map((response: MenuItemDto[]) => {
          return response;
        })
      );
  }

  getMenuItem(menuRequestDto: MenuRequestDto) {
    return this.httpClient
      .post(environment.apiUrl + 'menu/get-menuitem', menuRequestDto)
      .pipe(
        map((response: MenuItemDto) => {
          return response;
        })
      );
  }

  createMenuItem(createMenuItemDto: CreateMenuItemDto) {
    return this.httpClient
      .post(environment.apiUrl + 'menu/create-menuitem', createMenuItemDto)
      .pipe(
        map((response: MenuItemDto) => {
          return response;
        })
      );
  }

  editMenuItem(createMenuItemDto: CreateMenuItemDto) {
    return this.httpClient
      .post(environment.apiUrl + 'menu/edit-menuitem', createMenuItemDto)
      .pipe(
        map((response: MenuItemDto) => {
          return response;
        })
      );
  }

  deleteMenuItem(menuRequestDto: MenuRequestDto) {
    return this.httpClient.post(
      environment.apiUrl + 'menu/delete-menuitem',
      menuRequestDto
    );
  }
}
