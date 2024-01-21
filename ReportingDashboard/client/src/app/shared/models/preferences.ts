import { CreateOrderDto } from './create-order-dto';
import { MenuItemDto } from './menu-item-dto';
import { OrderDto } from './order-dto';
import { UserDto } from './user-dto';

export interface Preferences {
  branchId: string;
  tableNumber: string;
  countryDialingCode: string;
  phoneNumber: string;
  nextPage: string;
  order: MenuItemDto[];
  deliveryFee: MenuItemDto;
  createOrderDto: CreateOrderDto;
  orderResultDto: OrderDto;
  user: UserDto;
  //DHMS Hackathon
  currentCertFormSelected: any;

  certFormsPersistence: any;

  currentPermitFormSelected: any;

  permitFormsPersistence: any;
}
