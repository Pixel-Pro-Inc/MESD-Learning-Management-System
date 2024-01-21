import { PhoneNumber } from './phone-number';

export interface RegisterUserDto {
  firstname: string;
  lastname: string;
  username: string;
  permissions: string[];
  email: string;
  nationalIdentityNumber: string;
  password: string;
  phoneNumber: PhoneNumber;
}
