import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { DataGridInputComponent } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.component';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-information-2',
  templateUrl: './psdl-information-2.component.html',
  styleUrls: ['./psdl-information-2.component.css'],
})
export class PsdlInformation2Component implements OnInit {
  @ViewChild('dataGridCmp') dataGrid: DataGridInputComponent;
  constructor(
    private fb: FormBuilder,
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  serviceForm: FormGroup;
  parcelInformationData = {
    columns: [
      {
        field: 'lineItem',

        headerText: 'HS CLASSIFICATION',

        textAlign: 'Left',
      },
      {
        field: 'number',

        headerText: 'CARATS',

        textAlign: 'Right',
      },
      {
        field: 'value',

        headerText: 'VALUE (USD)',

        textAlign: 'Right',
      },
    ],
    data: [
      { lineItem: '7102.10', number: 0, value: 0 },
      { lineItem: '7102.21', number: 0, value: 0 },
      { lineItem: '7102.31', number: 0, value: 0 },
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
      if (prefs.certFormsPersistence.psdl2 != null) {
        this.parcelInformationData.data =
          prefs.certFormsPersistence.psdl2.parcelInformation;
      }
    }
    this.dataGrid.setTableValues(this.parcelInformationData);
  }

  delay(ms: number) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      capacity: ['', Validators.required],
      parcelInformation: [''],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl2 != null) {
        this.serviceForm.setValue(prefs.certFormsPersistence.psdl2);
      }
    }
  }

  next() {
    //Store form data
    //Save CSV
    let csv = this.dataGrid.getDataSource();

    this.serviceForm.controls.parcelInformation.setValue(csv);

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence == null) {
      prefs.certFormsPersistence = {};
    }

    prefs.certFormsPersistence.psdl2 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/kpc-information-3'
    );
  }

  previous() {
    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/kpc-information-1'
    );
  }
}
