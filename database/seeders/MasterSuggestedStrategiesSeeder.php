<?php

namespace Database\Seeders;

use App\Constants\Strategies\StrategyCategory;
use App\Constants\Strategies\StrategyType;
use App\Models\MasterSuggestedStrategy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterSuggestedStrategiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fill = [
            [
                "label" => "Increase Organizational Strength", 
                "text" => "Increase the organizational strength of supporters, by providing increased material resources or by providing experienced staff or by fostering political skills.",
                "category" => StrategyCategory::POWER,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Increase Access to Political Leaders", 
                "text" => "Increase access to political leaders, by organizing through a lobbying campaign.",
                "category" => StrategyCategory::POWER,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Mobilize Supporters", 
                "text" => "Mobilize supporters in groups and communities in public demonstrations to call for action",
                "category" => StrategyCategory::POWER,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Create Coalition of Supporters", 
                "text" => "Create a coalition of supporting groups or players, with a recognizable name and sufficient resources.",
                "category" => StrategyCategory::POWER,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Persuade Supporters to Change", 
                "text" => "Persuade supporters to strengthen their position, by reminding supporters of the promised benefits compared to other policies.",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Add More Benefits", 
                "text" => "Persuade supporters to strengthen their position, by adding more benefits as an incentive.",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Remove Objections", 
                "text" => "Persuade supporters to strengthen their position, by changing the policy to remove contested goals or mechanisms.",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Add Additional Policy Elements", 
                "text" => "Persuade supporters to strengthen their position, by adding desired goals and mechanisms to the policy.",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Create New Organization", 
                "text" => "Create a new organization or partnership of existing organizations and individuals.",
                "category" => StrategyCategory::PLAYER,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Persuade Non-mobilized Groups", 
                "text" => "Persuade non-mobilized groups to take a supporting position, by providing incentives, removing objections, or adding desired policy elements.",
                "category" => StrategyCategory::PLAYER,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Attract Political Leadership", 
                "text" => "Persuade political candidates or elected officials in the legislature or executive to adopt your issue, through personal meetings, position papers, or political incentives.",
                "category" => StrategyCategory::PLAYER,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Change Decision-making Processes", 
                "text" => "Change the decision-making processes (eg, through public hearings) in order to expand the number of supporters.",
                "category" => StrategyCategory::PLAYER,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Enhance Legitimacy", 
                "text" => "Enhance the legitimacy of supporters, by connecting them to positive social values.",
                "category" => StrategyCategory::PERCEPTION,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Use Symbols of Public Support", 
                "text" => "Use symbols to Increase public support of the policy, by organizing a media campaign or finding sympathetic victims.",
                "category" => StrategyCategory::PERCEPTION,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Use the Media", 
                "text" => "Use the media to increase public visibility of the issue and change perception of problem and solution",
                "category" => StrategyCategory::PERCEPTION,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Publicize Supporters' Position", 
                "text" => "Persuade supporters to take a more public stand on the policy.",
                "category" => StrategyCategory::PERCEPTION,
                "type" => StrategyType::SUPPORT
            ],
            [
                "label" => "Persuade Supporters to Change", 
                "text" => "Persuade non-mobilized to take a position of support, by promising them benefits compared to other policies.",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::NON_MOBILIZED
            ],
            [
                "label" => "Add More Benefits", 
                "text" => "Persuade non-mobilized to strengthen their position, by adding more benefits as an incentive.",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::NON_MOBILIZED
            ],
            [
                "label" => "Remove Objections", 
                "text" => "Persuade supporters to take a position of support, by changing the policy to remove contested goals or mechanisms.",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::NON_MOBILIZED
            ],
            [
                "label" => "Add Additional Policy Elements", 
                "text" => "Persuade non-mobilized to take a position of support, by adding desired goals and mechanisms to the policy.",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::NON_MOBILIZED
            ],
            [
                "label" => "Create New Organization", 
                "text" => "Create a new organization or partnership of existing organizations and individuals, to involve non-mobilized",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::NON_MOBILIZED
            ],
            [
                "label" => "Seek Common Goals or Values", 
                "text" => "Seek common goals or values with non-mobilized, to persuade them to take a public position of support",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::NON_MOBILIZED
            ],
            [
                "label" => "Persuade Non-mobilized Groups", 
                "text" => "Persuade non-mobilized groups to take a supporting position, by providing incentives, removing objections, or adding desired policy elements.",
                "category" => StrategyCategory::PLAYER,
                "type" => StrategyType::NON_MOBILIZED
            ],
            [
                "label" => "Enhance Legitimacy", 
                "text" => "Enhance the legitimacy of policy, by connecting it to positive social values.",
                "category" => StrategyCategory::PERCEPTION,
                "type" => StrategyType::NON_MOBILIZED
            ],
            [
                "label" => "Increase Public Support", 
                "text" => "Increase the public support for the policy, by organizing a media campaign or by finding sympathetic victims.",
                "category" => StrategyCategory::PERCEPTION,
                "type" => StrategyType::NON_MOBILIZED
            ],
            [
                "label" => "Use the Media", 
                "text" => "Use the media to increase public visibility of the issue and change perception of problem and solution",
                "category" => StrategyCategory::PERCEPTION,
                "type" => StrategyType::NON_MOBILIZED
            ],
            [
                "label" => "Publicize Supporters' Position", 
                "text" => "Persuade supporters to take a more public stand on the policy.",
                "category" => StrategyCategory::PERCEPTION,
                "type" => StrategyType::NON_MOBILIZED
            ],
            [
                "label" => "Undermine Legitimacy of Opposition", 
                "text" => "Undermine the legitimacy of the opposition, by connecting them to negative social values through negative publicity.",
                "category" => StrategyCategory::POWER,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Decrease Public Visibility", 
                "text" => "Decrease the public visibility of opponents, by reducing their media exposure or access.",
                "category" => StrategyCategory::POWER,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Decrease Organizational Strength", 
                "text" => "Decrease the organizational strength of the opposition, by denying them material resources.",
                "category" => StrategyCategory::POWER,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Reduce Opposition Coalitions", 
                "text" => "Reduce the strength of coalitions of opposing groups or individuals, by fostering internal tensions or by winning over a key member.",
                "category" => StrategyCategory::POWER,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Deny Information to Opponents", 
                "text" => "Deny information to opponents, including both technical and political information.",
                "category" => StrategyCategory::POWER,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Hire PR Firm to Monitor Opponents", 
                "text" => "Hire a professional public relations firm to monitor the opposition or to design a negative public relations campaign directed against the opposition.",
                "category" => StrategyCategory::POWER,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Seek Common Goals", 
                "text" => "Meet with opponents to seek common goals or mechanisms, and thereby reduce the intensity of their opposition.",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Compensate Opponents", 
                "text" => "Provide compensation to opponents for real and perceived harms, in order to reduce the intensity of their opposition.",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Add Additional Policy Elements", 
                "text" => "Persuade opponents to weak their position, by adding desired goals or mechanisms to the policy.",
                "category" => StrategyCategory::POSITION,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Remove Existing Organization", 
                "text" => "Decrease the number of opponents, by removing existing organizations or federations.",
                "category" => StrategyCategory::PLAYER,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "De-mobilize Opposition", 
                "text" => "Persuade opposing groups to move to a non-mobilized or supporting position, by providing incentives, removing objections, or adding desired policy elements.",
                "category" => StrategyCategory::PLAYER,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Find Persuasive Mediator", 
                "text" => "Find a persuasive mediator, to negotiate with opponents and find acceptable agreement to end their opposition.",
                "category" => StrategyCategory::PLAYER,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Threaten Legal Action", 
                "text" => "Threaten legal action against an opponent, raising the costs of opposition and persuading the player to cease its opposition.",
                "category" => StrategyCategory::PLAYER,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Change Decision-making Processes", 
                "text" => "Change decision-making processes, in order to prevent some opponents from participating.",
                "category" => StrategyCategory::PLAYER,
                "type" => StrategyType::OPPOSITION
            ],
            [
                "label" => "Negotiate on Other Issues", 
                "text" => "Negotiate with the opposition, and offer concessions on other policies of interest, in exchange for reversal of opposition.",
                "category" => StrategyCategory::PLAYER,
                "type" => StrategyType::OPPOSITION
            ],
        ];

        foreach($fill as $_fill){
            MasterSuggestedStrategy::create($_fill);
        }
    }
}
