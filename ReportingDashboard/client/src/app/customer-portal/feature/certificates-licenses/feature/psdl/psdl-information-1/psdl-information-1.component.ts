import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { DataGridInputComponent } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.component';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-information-1',
  templateUrl: './psdl-information-1.component.html',
  styleUrls: ['./psdl-information-1.component.css'],
})
export class PsdlInformation1Component implements OnInit {
  @ViewChild('dataGridCmp') dataGrid: DataGridInputComponent;
  constructor(
    private fb: FormBuilder,
    private toastService: ToastrService,
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  serviceForm: FormGroup;

  directorData = {
    columns: [
      {
        field: 'names',

        headerText: 'Full Names of Directors',

        textAlign: 'Left',
      },
      {
        field: 'nationalities',

        headerText: 'Directors Nationalities',

        textAlign: 'Left',
      },
    ],
    data: [
      { names: 'Name', nationalities: 'Nationality' },
      { names: 'Name', nationalities: 'Nationality' },
    ],
  };

  ngOnInit(): void {
    this.initializeForm();
  }

  ngAfterViewInit(): void {
    this.initExcel();
  }

  async initExcel() {
    await this.delay(100);
    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl1 != null) {
        this.directorData.data =
          prefs.certFormsPersistence.psdl1.directorsDetails;
      }
    }

    this.dataGrid.setTableValues(this.directorData);
  }

  delay(ms: number) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      name: ['', Validators.required],
      manufacturingLicenseNumber: ['', Validators.required],
      address: ['', Validators.required],
      directorsDetails: [''],
      authorizedShareCapital: ['', Validators.required],
      issuedShareCapital: ['', Validators.required],
      experience: ['', Validators.required],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl1 != null) {
        this.serviceForm.setValue(prefs.certFormsPersistence.psdl1);
      }
    }
  }

  next() {
    //Store form data
    //Save CSV
    let csv = this.dataGrid.getDataSource();

    this.serviceForm.controls.directorsDetails.setValue(csv);

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence == null) {
      prefs.certFormsPersistence = {};
    }

    prefs.certFormsPersistence.psdl1 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-2'
    );
  }

  previous() {
    this.routerService.navigateByUrl('/portal/certificates-licenses/service');
  }
}
