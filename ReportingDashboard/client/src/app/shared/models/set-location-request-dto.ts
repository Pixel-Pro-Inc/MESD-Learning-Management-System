import { LocationDto } from './location-dto';
import { PhoneNumber } from './phone-number';

export interface SetLocationRequestDto {
  location: LocationDto;
  phoneNumber: PhoneNumber;
}
