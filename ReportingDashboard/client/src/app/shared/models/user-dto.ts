export interface UserDto {
  id: string;
  firstName: string;
  accountEnabled: boolean;
  lastName: string;
  username: string;
  nationalIdentityNumber: string;
  token: string;
  branchIds: string[];
  permissions: string[];
  email: string;
}
