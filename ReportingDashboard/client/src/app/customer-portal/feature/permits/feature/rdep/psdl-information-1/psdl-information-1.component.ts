import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-information-1',
  templateUrl: './psdl-information-1.component.html',
  styleUrls: ['./psdl-information-1.component.css'],
})
export class PsdlInformation1Component implements OnInit {
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
      name: ['', Validators.required],
      originCountry: ['', Validators.required],
      diamondType: ['', Validators.required],
      exportAddress: ['', Validators.required],
      exportReason: ['', Validators.required],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.permitFormsPersistence != null) {
      if (prefs.permitFormsPersistence.psdl1 != null) {
        this.serviceForm.setValue(prefs.permitFormsPersistence.psdl1);
      }
    }
  }

  next() {
    //Store form data
    let prefs = this.preferencesService.getPreferences();

    if (prefs.permitFormsPersistence == null) {
      prefs.permitFormsPersistence = {};
    }

    prefs.permitFormsPersistence.psdl1 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl('/portal/permits/rdep-information-2');
  }

  previous() {
    this.routerService.navigateByUrl('/portal/permits/service');
  }
}
