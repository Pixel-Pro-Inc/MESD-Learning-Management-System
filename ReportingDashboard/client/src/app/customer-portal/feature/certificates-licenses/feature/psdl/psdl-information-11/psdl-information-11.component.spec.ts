import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlInformation11Component } from './psdl-information-11.component';

describe('PsdlInformation11Component', () => {
  let component: PsdlInformation11Component;
  let fixture: ComponentFixture<PsdlInformation11Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PsdlInformation11Component],
    }).compileComponents();

    fixture = TestBed.createComponent(PsdlInformation11Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
