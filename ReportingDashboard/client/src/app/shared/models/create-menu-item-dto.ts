import { MenuItemDto } from './menu-item-dto';

export interface CreateMenuItemDto {
  branchId: string;
  menuItemDto: MenuItemDto;
}
