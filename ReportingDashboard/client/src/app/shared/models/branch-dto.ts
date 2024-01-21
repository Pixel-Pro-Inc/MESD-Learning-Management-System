import { PhoneNumber } from './phone-number';

export interface BranchDto {
  name: string;
  shortName: string;
  branchId: string;
  phoneNumbers: PhoneNumber[];
  openingTime: string;
  closingTime: string;
  openingTimes: string[];
  closingTimes: string[];
  currency: string;
  deliveryAvailable: boolean;
  distance: string;
  countryCode: string;
  location: any;
  minimumDeliveryAmount: number;
  minimumCardPaymentAmount: number;
  timeZone: number;
  deliveryRadius: number;
}
