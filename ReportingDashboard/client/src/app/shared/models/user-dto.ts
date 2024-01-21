import { PhoneNumber } from './phone-number';

export interface UserDto {
  id: string;
  firstName: string;
  accountEnabled: boolean;
  lastName: string;
  username: string;
  phoneNumber: PhoneNumber;
  nationalIdentityNumber: string;
  token: string;
  branchIds: string[];
  permissions: string[];
  email: string;
}
