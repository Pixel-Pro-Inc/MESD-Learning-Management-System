import { Injectable } from '@angular/core';
import { LocationDto } from '../../models/location-dto';
import { map } from 'rxjs/operators';
import { environment } from 'src/environments/environment';
import { LocationRequestDto } from '../../models/location-request-dto';
import { HttpClient } from '@angular/common/http';
import { SetLocationRequestDto } from '../../models/set-location-request-dto';

@Injectable({
  providedIn: 'root',
})
export class LocationService {
  constructor(private httpClient: HttpClient) {}

  getCurrentLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position: GeolocationPosition) => {
          if (position) {
            let locationDto: LocationDto = {
              latitude: position.coords.latitude,
              longitude: position.coords.longitude,
              addressName: 'location',
              index: 0,
              physicalAddress: '',
              defaultZoomLevel: 0,
              extraAddressInfo: '',
              countryCode: '',
            };

            return locationDto;
          }
        },
        (error) => {
          return null;
        }
      );
    }

    return null;
  }

  getCustomerLocations(locationRequestDto: LocationRequestDto) {
    return this.httpClient
      .post(
        environment.apiUrl + 'location/get-customer-locations',
        locationRequestDto
      )
      .pipe(
        map((response: LocationDto[]) => {
          return response;
        })
      );
  }

  deleteCustomerLocation(locationRequestDto: LocationRequestDto) {
    return this.httpClient.post(
      environment.apiUrl + 'location/delete-customer-location',
      locationRequestDto
    );
  }

  setCustomerLocation(setLocationRequestDto: SetLocationRequestDto) {
    return this.httpClient.post(
      environment.apiUrl + 'location/set-map-info',
      setLocationRequestDto
    );
  }
}
