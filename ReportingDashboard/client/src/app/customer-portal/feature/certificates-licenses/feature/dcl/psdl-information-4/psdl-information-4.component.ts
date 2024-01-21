import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-information-4',
  templateUrl: './psdl-information-4.component.html',
  styleUrls: ['./psdl-information-4.component.css'],
})
export class PsdlInformation4Component implements OnInit {
  constructor(
    private fb: FormBuilder,
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  serviceForm: FormGroup;

  ngOnInit(): void {
    this.initializeForm();
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      propertyValue: ['', Validators.required],
      otherAssets: ['', Validators.required],
      capital: ['', Validators.required],
      cash: ['', Validators.required],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl4 != null) {
        this.serviceForm.setValue(prefs.certFormsPersistence.psdl4);
      }
    }
  }

  next() {
    //Store form data

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence == null) {
      prefs.certFormsPersistence = {};
    }

    prefs.certFormsPersistence.psdl4 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/dcl-information-5'
    );
  }

  previous() {
    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/dcl-information-3'
    );
  }
}
