import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class BannerComponent extends Vue
{
    @Prop() private msg!: string;
}
