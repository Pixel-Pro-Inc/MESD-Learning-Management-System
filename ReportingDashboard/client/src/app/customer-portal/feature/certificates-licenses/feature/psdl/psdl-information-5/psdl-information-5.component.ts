import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-information-5',
  templateUrl: './psdl-information-5.component.html',
  styleUrls: ['./psdl-information-5.component.css'],
})
export class PsdlInformation5Component implements OnInit {
  constructor(
    private fb: FormBuilder,
    private toastService: ToastrService,
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
      typesQuantitiesStones: ['', Validators.required],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl5 != null) {
        this.serviceForm.setValue(prefs.certFormsPersistence.psdl5);
      }
    }
  }

  next() {
    //Store form data

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence == null) {
      prefs.certFormsPersistence = {};
    }

    prefs.certFormsPersistence.psdl5 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-6'
    );
  }

  previous() {
    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-4'
    );
  }
}
