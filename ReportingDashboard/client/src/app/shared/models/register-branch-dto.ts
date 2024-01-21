import { PhoneNumber } from './phone-number';

export interface RegisterBranchDto {
  name: string;
  shortName: string;
  phoneNumbers: PhoneNumber[];
  openingTimes: any[];
  closingTimes: any[];
  location: any;
  currency: string;
  timeZone: number;
  minimumDeliveryAmount: number;
  minimumCardPaymentAmount: number;
  deliveryRadius: number;
  licensingRate: number;
  subscriptionLevel: string;
  deliveryProfitSharing: number;
}
