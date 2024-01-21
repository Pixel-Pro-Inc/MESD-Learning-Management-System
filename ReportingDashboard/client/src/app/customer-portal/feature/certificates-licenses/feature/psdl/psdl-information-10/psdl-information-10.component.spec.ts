import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlInformation10Component } from './psdl-information-10.component';

describe('PsdlInformation10Component', () => {
  let component: PsdlInformation10Component;
  let fixture: ComponentFixture<PsdlInformation10Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PsdlInformation10Component],
    }).compileComponents();

    fixture = TestBed.createComponent(PsdlInformation10Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
