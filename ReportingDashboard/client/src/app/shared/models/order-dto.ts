import { MenuItemDto } from './menu-item-dto';

export interface OrderDto {
  orderNumber: string;
  preparationTime: string;
  orderDateTime: string;
  branchId: string;
  menuItems: MenuItemDto[];
  order: any;
}
