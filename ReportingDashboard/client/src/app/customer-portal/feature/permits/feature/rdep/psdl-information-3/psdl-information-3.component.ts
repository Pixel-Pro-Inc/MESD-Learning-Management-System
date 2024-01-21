import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { DataGridInputComponent } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.component';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-information-3',
  templateUrl: './psdl-information-3.component.html',
  styleUrls: ['./psdl-information-3.component.css'],
})
export class PsdlInformation3Component implements OnInit {
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
        field: 'number',

        headerText: 'RETURNED CARATS',

        textAlign: 'Right',
      },
      {
        field: 'value',

        headerText: 'NOT RETURNED CARATS',

        textAlign: 'Right',
      },
    ],
    data: [{ number: 0, value: 0 }],
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

    if (prefs.permitFormsPersistence != null) {
      if (prefs.permitFormsPersistence.psdl3 != null) {
        this.parcelInformationData.data =
          prefs.permitFormsPersistence.psdl3.parcelInformationReturns;
      }
    }
    this.dataGrid.setTableValues(this.parcelInformationData);
  }

  delay(ms: number) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      parcelInformationReturns: [''],
      loanDetails: [''],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.permitFormsPersistence != null) {
      if (prefs.permitFormsPersistence.psdl3 != null) {
        this.serviceForm.setValue(prefs.permitFormsPersistence.psdl3);
      }
    }
  }

  next() {
    //Store form data
    //Save CSV
    let csv = this.dataGrid.getDataSource();

    this.serviceForm.controls.parcelInformationReturns.setValue(csv);

    let prefs = this.preferencesService.getPreferences();

    if (prefs.permitFormsPersistence == null) {
      prefs.permitFormsPersistence = {};
    }

    prefs.permitFormsPersistence.psdl3 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl('/portal/permits/rdep-information-4');
  }

  previous() {
    this.routerService.navigateByUrl('/portal/permits/rdep-information-2');
  }
}
