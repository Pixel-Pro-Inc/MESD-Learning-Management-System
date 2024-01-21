import { LocationDto } from './location-dto';

export interface BranchRequestDto {
  branchId: string;
  locationDto: LocationDto;
}
