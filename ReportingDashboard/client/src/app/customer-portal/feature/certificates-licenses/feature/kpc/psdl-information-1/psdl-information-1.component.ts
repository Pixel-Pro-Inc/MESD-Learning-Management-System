import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
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
      name: [''],
      originCountry: ['', Validators.required],
      parcelNumber: ['', Validators.required],
      exporterParticulars: ['', Validators.required],
      importerParticulars: ['', Validators.required],
    });

    let prefs = this.preferencesService.getPreferences();

    this.serviceForm.controls.name.setValue(
      `${prefs.user.firstName} ${prefs.user.lastName}`
    );

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl1 != null) {
        this.serviceForm.setValue(prefs.certFormsPersistence.psdl1);
      }
    }
  }

  next() {
    //Store form data
    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence == null) {
      prefs.certFormsPersistence = {};
    }

    prefs.certFormsPersistence.psdl1 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/kpc-information-2'
    );
  }

  previous() {
    this.routerService.navigateByUrl('/portal/certificates-licenses/service');
  }
}
