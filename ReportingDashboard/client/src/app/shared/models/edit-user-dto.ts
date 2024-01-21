import { PhoneNumber } from './phone-number';

export interface EditUserDto {
  id: string;
  firstName: string;
  accountEnabled: boolean;
  lastName: string;
  username: string;
  phoneNumber: PhoneNumber;
  nationalIdentityNumber: string;
  permissions: string[];
  email: string;
}
