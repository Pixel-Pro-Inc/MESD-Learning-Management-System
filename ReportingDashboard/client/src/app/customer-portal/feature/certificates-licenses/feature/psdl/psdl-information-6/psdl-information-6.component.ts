import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-information-6',
  templateUrl: './psdl-information-6.component.html',
  styleUrls: ['./psdl-information-6.component.css'],
})
export class PsdlInformation6Component implements OnInit {
  constructor(
    private fb: FormBuilder,
    private toastService: ToastrService,
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  serviceForm: FormGroup;
  initialCoordinates;

  ngOnInit(): void {
    this.initializeForm();
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      location: [null, Validators.required],
      sourceStones: ['', Validators.required],
      market: ['', Validators.required],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl6 != null) {
        this.serviceForm.setValue(prefs.certFormsPersistence.psdl6);
        this.initialCoordinates = {
          lat: prefs.certFormsPersistence.psdl6.location.latitude,
          lng: prefs.certFormsPersistence.psdl6.location.longitude,
        };
      }
    }
  }

  count = 0;
  public locationSelected(location: any) {
    if (this.count == 0) {
      this.count++;
      return;
    }

    this.serviceForm.controls.location.setValue({
      latitude: location.latitude,
      longitude: location.longitude,
      physicalAddress: location.address,
      index: 0,
      defaultZoomLevel: 14,
      addressName: '',
      extraAddressInfo: '',
      countryCode: '',
    });
  }

  next() {
    //Store form data

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence == null) {
      prefs.certFormsPersistence = {};
    }

    prefs.certFormsPersistence.psdl6 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-7'
    );
  }

  previous() {
    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-5'
    );
  }
}
