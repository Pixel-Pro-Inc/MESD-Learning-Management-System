import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-information-7',
  templateUrl: './psdl-information-7.component.html',
  styleUrls: ['./psdl-information-7.component.css'],
})
export class PsdlInformation7Component implements OnInit {
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
      typesQuantitiesOtherInputs: ['', Validators.required],
      expectedSales: ['', Validators.required],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl7 != null) {
        this.serviceForm.setValue(prefs.certFormsPersistence.psdl7);
      }
    }
  }

  next() {
    //Store form data
    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence == null) {
      prefs.certFormsPersistence = {};
    }

    prefs.certFormsPersistence.psdl7 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-8'
    );
  }

  previous() {
    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-6'
    );
  }
}
