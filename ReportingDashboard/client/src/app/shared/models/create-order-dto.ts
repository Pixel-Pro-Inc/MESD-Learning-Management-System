import { MenuItemDto } from './menu-item-dto';

export interface CreateOrderDto {
  menuItems: MenuItemDto[];
  branchId: string;
  tableNumber: string;
  phoneNumber: string;
  countryDialingCode: string;
  locationIndex: number;
  paidOnline: boolean;
  shouldPayOnline: boolean;
  delivery: boolean;
  orderScheduleTime: string;
  redirectUrl: string;
}
