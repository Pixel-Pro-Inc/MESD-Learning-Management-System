import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { CertificatesLicensesComponent } from '../certificates-licenses/certificates-licenses.component';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-document-form-service',
  templateUrl: './document-form-service.component.html',
  styleUrls: ['./document-form-service.component.css'],
})
export class DocumentFormServiceComponent implements OnInit {
  constructor(
    private fb: FormBuilder,
    private routerService: Router,
    private preferencesService: PreferencesService
  ) {}

  parent: CertificatesLicensesComponent;
  serviceForm: FormGroup;

  ngOnInit(): void {
    this.initializeForm();
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      service: ['', Validators.required],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.service != null) {
        this.serviceForm.setValue(prefs.certFormsPersistence.service);
      }
    }
  }

  selectService() {
    //Store form data

    //Set forms to use
    if (
      this.serviceForm.controls.service.value ==
      'Precious Stone Dealers License'
    ) {
      this.parent.items = this.parent.itemsPSDL;

      this.routerService.navigateByUrl(
        '/portal/certificates-licenses/psdl-information-1'
      );
    }
    if (this.serviceForm.controls.service.value == 'Diamond Cutting License') {
      this.parent.items = this.parent.itemsDCL;

      this.routerService.navigateByUrl(
        '/portal/certificates-licenses/dcl-information-1'
      );

      console.log('hello there');
    }
    if (
      this.serviceForm.controls.service.value == 'Kimberly Process Certificate'
    ) {
      this.parent.items = this.parent.itemsKPC;

      this.routerService.navigateByUrl(
        '/portal/certificates-licenses/kpc-information-1'
      );

      console.log('hello there');
    }

    let prefs = this.preferencesService.getPreferences();

    if (prefs.currentCertFormSelected != null && this.parent.items != null) {
      if (
        prefs.currentCertFormSelected[1].routerLink !=
        this.parent.items[1].routerLink
      ) {
        prefs.certFormsPersistence = {};
      }
    }

    if (prefs.certFormsPersistence == null) {
      prefs.certFormsPersistence = {};
    }

    prefs.currentCertFormSelected = this.parent.items;

    prefs.certFormsPersistence.service = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);
  }
}
