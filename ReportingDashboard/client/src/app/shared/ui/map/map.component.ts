import {
  Component,
  ElementRef,
  EventEmitter,
  Input,
  OnInit,
  Output,
  ViewChild,
} from '@angular/core';
import { GoogleMap } from '@angular/google-maps';

@Component({
  selector: 'app-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.css'],
})
export class MapComponent implements OnInit {
  @ViewChild('mapSearchField') searchField: ElementRef;
  @ViewChild(GoogleMap) map: GoogleMap;
  @Input() PinLabel: string = 'Deliver Here';
  @Input() initialCoordinates;
  @Output() onLocationSelected = new EventEmitter<any>();

  constructor() {}

  markers = [];

  mapConfigurations = {
    disableDefaultUI: true,
    zoomControl: true,
  };

  ngOnInit(): void {}

  ngAfterViewInit(): void {
    navigator.geolocation.getCurrentPosition((position) => {
      if (this.initialCoordinates == null) {
        this.initialCoordinates = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };
      }

      this.addMarker(this.initialCoordinates.lat, this.initialCoordinates.lng);
    });

    const searchBox = new google.maps.places.SearchBox(
      this.searchField.nativeElement
    );
    this.map.controls[google.maps.ControlPosition.TOP_CENTER].push(
      this.searchField.nativeElement
    );

    searchBox.addListener('places_changed', () => {
      const places = searchBox.getPlaces();
      if (places.length === 0) {
        return;
      }
      const bounds = new google.maps.LatLngBounds();
      places.forEach((place) => {
        if (!place.geometry || !place.geometry.location) {
          return;
        }
        if (place.geometry.viewport) {
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      this.map.fitBounds(bounds);

      this.addMarker(bounds.getCenter().lat(), bounds.getCenter().lng());
    });
  }

  centerMarkerAndMap(event: google.maps.MapMouseEvent) {
    this.map.panTo(event.latLng);

    this.addMarker(event.latLng.lat(), event.latLng.lng());
  }

  addMarker(lat: number, lng: number) {
    this.markers = [];

    this.markers.push({
      position: {
        lat: lat,
        lng: lng,
      },
      options: { animation: google.maps.Animation.DROP },
    });

    this.setGeoLocation(lat, lng);
  }

  setGeoLocation(lat: number, lng: number) {
    if (navigator.geolocation) {
      let geocoder = new google.maps.Geocoder();
      let latlng = new google.maps.LatLng(lat, lng);

      geocoder.geocode({ location: latlng }, (results, status) => {
        if (status == google.maps.GeocoderStatus.OK) {
          let result = results[0];

          if (result != null) {
            this.onLocationSelected.emit({
              address: result.formatted_address,
              latitude: lat,
              longitude: lng,
            });
          }
        }
      });
    }
  }
}
